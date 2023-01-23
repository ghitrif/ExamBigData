<template>
  <div class="flowchart-container" 
    @mousemove="handleMove" 
    @mouseup="handleUp"
    @mousedown="handleDown" style="margin-top:60px">
    <svg width="100%" height="100%">
      <flowchart-link v-bind.sync="link" 
        v-for="(link, index) in lines_" 
        :key="`link${index}`"
        :color="'#000'"
        :datalink="link"
        @deleteLink="linkDelete(link)">
      </flowchart-link>
    </svg>

    
    
    
    <flowchart-node v-bind.sync="node" 
      v-for="(node, index) in scene.nodes" 
      :key="`node${index}`"
      :i="index"
      :options="nodeOptions"
      :image="node.thumbnail"
      :label="node.name"
      :node="node"
      :funnel="funnel"
      
      @linkingStart="linkingStart"
      @linkingStop="linkingStop"
      @deleteNode="trashVideoNode(node, index)"
      @nodeSelected="nodeSelected(node.id, $event)">
    </flowchart-node>

    
  </div>
</template>

<script>
import FlowchartLink from './FlowchartLink.vue';
import FlowchartNode from './FlowchartNode.vue';
import { getMousePosition } from '../assets/utilty/position';

import { mapGetters, mapActions } from "vuex";
export default {
  name: 'VueFlowchart',
  props: {
    scene: {
      type: Object,
      default() {
        return {
          centerX: 1024,
          scale: 1,
          centerY: 140,
          nodes: [],
          links: [],
        }
      }
    },
    height: {
      type: Number,
      default: 400,
    },
    funnel: {
      type: Object,
    }
  },
  data() {
    return {
      editVideo:false,
      link_:{
                        id: 3,
                        from: 2, // node id the link start
                        to: 4,  // node id the link end
                    },
      action: {
        linking: false,
        dragging: false,
        scrolling: false,
        selected: 0,
      },
      mouse: {
        x: 0,
        y: 0,
        lastX: 0,
        lastY: 0,
      },
      draggingLink: null,
      rootDivOffset: {
        top: 0,
        left: 0
      },
    };
  },
  components: {
    FlowchartLink,
    FlowchartNode,
  },
  computed: {
    nodeOptions() {
      return {
        centerY: this.scene.centerY,
        centerX: this.scene.centerX,
        scale: this.scene.scale,
        offsetTop: this.rootDivOffset.top,
        offsetLeft: this.rootDivOffset.left,
        selected: this.action.selected,
      }
    },
    get_links(){
      var lk = []      
      this.scene.nodes.map((node) => {
        // if(node.type == 'Multiple Choices' || node.type == 'start'){
          node.nodes.map((node_, index) => {
            if(node_.goto_id){
              const video = this.scene.nodes.find(element => element.id == node_.goto_id);
              if(video)
                  lk.push({
                          id: index,
                          from: node.id, 
                          to: node_.goto_id, 
                          type: node_.answer, 
                          video_id: node_.video_id, 
                          answer_id: node_.id, 
                          goto_id: node_.goto_id, 
                          index:index,
                      })
            }              
          })
        // }
      })
      return lk
    },
    lines_(){
      let links = this.get_links
      let linkssss = [
                    {
                        id: 1,
                        from: 17, // node id the link start
                        to: 18,  // node id the link end
                        index:0
                    },
                    {
                        id: 2,
                        from: 17, // node id the link start
                        to: 19,  // node id the link end
                        index:1
                    },                    
                    {
                        id: 2,
                        from: 17, // node id the link start
                        to: 18,  // node id the link end
                        index:2
                    },  
                ]
      
      const lines = links.map((link) => {
        // if(!link.type )
        //   link.index = 0
        
        const fromNode = this.findNodeWithID(link.from)
        const toNode = this.findNodeWithID(link.to)
        let x, y, cy, cx, ex, ey;
        x = this.scene.centerX + fromNode.x + 110;
        y = this.scene.centerY + fromNode.y + 50 + ((link.index * 35) - link.index*2) ;
        if(!link.type ){          
          x = this.scene.centerX + fromNode.x + 110;
          y = this.scene.centerY + fromNode.y - 25 ;
        }
        [cx, cy] = this.getPortPosition('bottom', x, y);
        x = this.scene.centerX + toNode.x - 40;
        y = this.scene.centerY + toNode.y + 50;
        [ex, ey] = this.getPortPosition('top', x, y);
        return { 
          start: [cx, cy], 
          end: [ex, ey],
          id: link.id,
          color: link.color,
          answer_id:link.answer_id,
          video_id:link.video_id,
          goto_id:link.goto_id
        };
      })
      if (this.draggingLink) {
        let x, y, cy, cx;
        const fromNode = this.findNodeWithID(this.draggingLink.from)
        x = this.scene.centerX + fromNode.x + 110;
        y = this.scene.centerY + fromNode.y + 50 + ((this.draggingLink.index * 35) - this.draggingLink.index*2);
        if(!this.draggingLink.btn.answer){
          x = this.scene.centerX + fromNode.x + 110;
          y = this.scene.centerY + fromNode.y - 25;
        }
       [cx, cy] = this.getPortPosition('bottom', x, y);
        lines.push({ 
          start: [cx, cy], 
          end: [this.draggingLink.mx, this.draggingLink.my],
        })
      }
      
      return lines;

    },
    lines() {
      const lines = this.scene.links.map((link) => {
        const fromNode = this.findNodeWithID(link.from)
        const toNode = this.findNodeWithID(link.to)
        let x, y, cy, cx, ex, ey;
        x = this.scene.centerX + fromNode.x + 110;
        y = this.scene.centerY + fromNode.y - 30 ;
        [cx, cy] = this.getPortPosition('bottom', x, y);
        x = this.scene.centerX + toNode.x - 40;
        y = this.scene.centerY + toNode.y + 50;
        [ex, ey] = this.getPortPosition('top', x, y);
        return { 
          start: [cx, cy], 
          end: [ex, ey],
          id: link.id,
          color: link.color
        };
      })
      if (this.draggingLink) {
        let x, y, cy, cx;
        const fromNode = this.findNodeWithID(this.draggingLink.from)
        x = this.scene.centerX + fromNode.x + 60;
        y = this.scene.centerY + fromNode.y - 70;
        [cx, cy] = this.getPortPosition('bottom', x, y);
        // push temp dragging link, mouse cursor postion = link end postion 
        lines.push({ 
          start: [cx, cy], 
          end: [this.draggingLink.mx, this.draggingLink.my],
        })
      }
      return lines;
    }
  },
  mounted() {
    this.rootDivOffset.top = this.$el ? this.$el.offsetTop : 0;
    this.rootDivOffset.left = this.$el ? this.$el.offsetLeft : 0;
    // console.log(22222, this.rootDivOffset);
  },
  methods: {    
    ...mapActions(["CreateBtnNode", "DeleteBtnNode", "DeleteFunnelVideo", "deleteNodeLink"]),    
    async trashBtnNode(node){
      //this.$vs.loading({type:"sound"})
      let res = await this.DeleteBtnNode(node)
      //this.$vs.loading.close()
    },
    async trashVideoNode(video, i){
      let result = await this.$Swall.fire({title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'})
      if (!result.isConfirmed)
          return false
      this.$vs.loading({type:"sound"})
      let res = await  this.DeleteFunnelVideo(video.id)
      this.$vs.loading.close()
      this.scene.nodes.splice(i,1)
      this.$vs.notify({title:'Success',text:'Video Deleted Successfully',color:'success'})

    },
    findNodeWithID(id) {
      return this.scene.nodes.find((item) => {
          return id === item.id
      })
    },
    getPortPosition(type, x, y) {
      if (type === 'top') {
        return [x + 40, y];
      }
      else if (type === 'bottom') {
        return [x + 40, y + 80];
      }
    },
    linkingStart( index, i, btn) {
      this.action.linking = true;
      this.draggingLink = {
        from: index,
        index:i,
        to:0,
        mx: 0,
        my: 0,
        btn: btn
      };
    },
    async linkingStop(index, node) {
      // add new Link
      if (this.draggingLink && this.draggingLink.from !== index) {
        // check link existence
        const existed = this.scene.links.find((link) => {
          return link.from === this.draggingLink.from && link.to === index;
        })
        if (!existed) {
          // let maxID = Math.max(0, ...this.scene.links.map((link) => {
          //   return link.id
          // }))
          // const newLink = {
          //   id: node.nodes.length+1,
          //   from: this.draggingLink.from,
          //   from: this.draggingLink.from,
          //   to: index,
          // };
          let lk = this.get_links
          this.draggingLink.to = node.id
          this.draggingLink.btn.goto_id = node.id
          
          this.draggingLink.btn.action = 'Jump To Video'
          this.draggingLink.index = lk.length + 1
          this.CreateBtnNode(this.draggingLink.btn)
          
          // this.scene.links.push(newLink)
          // this.$emit('linkAdded', newLink)
        }
      }
      this.draggingLink = null
    },
    async linkDelete(link) {
      var deletedLink = this.scene.nodes.find((item) => {
          return item.id === link.video_id;
      });
      if (deletedLink) {
        
        var answer_id = deletedLink.nodes.find((item) => {
            return item.id == link.answer_id;
        });
        if(answer_id){
          let result = await this.$Swall.fire({title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'})
          if (!result.isConfirmed)
              return false
          answer_id.goto_id = null
          await this.deleteNodeLink(answer_id);

        }
      }
    },
    nodeSelected(id, e) {
      this.action.dragging = id;
      this.action.selected = id;
      this.$emit('nodeClick', id);
      this.mouse.lastX = e.pageX || e.clientX + document.documentElement.scrollLeft
      this.mouse.lastY = e.pageY || e.clientY + document.documentElement.scrollTop
    },
    handleMove(e) {
      if (this.action.linking) {
        console.log("🚀 ~ file: SimpleFlowchart.vue ~ line 259 ~ handleMove ~ this.action.linking", this.action.linking)
        let pos = getMousePosition(this.$el, e);
        this.mouse.x = pos[0]
        this.mouse.y = pos[1]
        this.draggingLink.mx =this.mouse.x 
        this.draggingLink.my =this.mouse.y
      }
      if (this.action.dragging) {
        this.mouse.x = e.pageX || e.clientX + document.documentElement.scrollLeft
        this.mouse.y = e.pageY || e.clientY + document.documentElement.scrollTop
        let diffX = this.mouse.x - this.mouse.lastX;
        let diffY = this.mouse.y - this.mouse.lastY;

        this.mouse.lastX = this.mouse.x;
        this.mouse.lastY = this.mouse.y;
        this.moveSelectedNode(diffX, diffY);
      }
      if (this.action.scrolling) {
        [this.mouse.x, this.mouse.y] = getMousePosition(this.$el, e);
        let diffX = this.mouse.x - this.mouse.lastX;
        let diffY = this.mouse.y - this.mouse.lastY;

        this.mouse.lastX = this.mouse.x;
        this.mouse.lastY = this.mouse.y;

        this.scene.centerX += diffX;
        this.scene.centerY += diffY;

        this.hasDragged = true
      }
    },
    handleUp(e) {
      const target = e.target || e.srcElement;
      if (this.$el.contains(target)) {
        if (typeof target.className !== 'string' || target.className.indexOf('node-input') < 0) {
          this.draggingLink = null;
        }
        if (typeof target.className === 'string' && target.className.indexOf('node-delete') > -1) {
          // console.log('delete2', this.action.dragging);
          this.nodeDelete(this.action.dragging);
        }
      }
      this.action.linking = false;
      this.action.dragging = null;
      this.action.scrolling = false;
    },
    handleDown(e) {
      const target = e.target || e.srcElement;
      // console.log('for scroll', target, e.keyCode, e.which)
      if ((target === this.$el || target.matches('svg, svg *')) && e.which === 1) {
        this.action.scrolling = true;
        [this.mouse.lastX, this.mouse.lastY] = getMousePosition(this.$el, e);
        this.action.selected = null; // deselectAll
      }
      this.$emit('canvasClick', e);
    },
    moveSelectedNode(dx, dy) {
      let index = this.scene.nodes.findIndex((item) => {
        return item.id === this.action.dragging
      })
      let left = this.scene.nodes[index].x + dx / this.scene.scale;
      let top = this.scene.nodes[index].y + dy / this.scene.scale;
      this.$set(this.scene.nodes, index, Object.assign(this.scene.nodes[index], {
        x: left,
        y: top,
      }));
    },
    nodeDelete(id) {
      this.scene.nodes = this.scene.nodes.filter((node) => {
        return node.id !== id;
      })
      this.scene.links = this.scene.links.filter((link) => {
        return link.from !== id && link.to !== id
      })
      this.$emit('nodeDelete', id)
    }
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
.flowchart-container {
  margin: 0px !important;
  background: transparent;
  position: relative;
  overflow: hidden;
  height: calc(100% );
  svg {
    cursor: grab;
  }
}
.scall{
      position: absolute;
    bottom: 0px;
    right: 0px;
    z-index: 9999999999;
    color: black;
    font-size: 20px;
}
</style>
