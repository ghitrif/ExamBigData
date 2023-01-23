<style lang="scss">
  @import '../scss/icons';
</style>

<template>
<span class="sendaudio" @click="upload" style="    display: inline-block;
    position: inherit;
        background: var(--PrimaryBgColor);
    color: var(--PrimaryTextColor);
    padding: 10px;
    overflow: visible;
    padding: 10px 30px;
    margin-top: 10px;    
    border-radius: var(--Btnradius);
    cursor:pointer">
  Send
</span>
</template>

<script>
  import IconButton from './icon-button'
  import UploaderPropsMixin from '../mixins/uploader-props'

  export default {
    mixins: [UploaderPropsMixin],
    props: {
      video: { type: Object },
      visitor: {},
      record: { type: Object }
    },
    components: {
      IconButton
    },
    methods: {
      async upload () {
        if (!this.record.url) {
          return
        }

        this.$eventBus.$emit('start-upload')

        const data = new FormData()
        data.append('media', this.record.blob, `${this.filename}.mp3`)
        data.append('video', this.video.id)
        data.append('visitor', this.visitor)

        const headers = Object.assign(this.headers, {})
        headers['Content-Type'] = `multipart/form-data; boundary=${data._boundary}`

        this.$http.post(this.uploadUrl, data, { headers: headers }).then(resp => {
          this.$eventBus.$emit('end-upload', { status: 'success', response: resp })
        }).catch(error => {
          this.$eventBus.$emit('end-upload', { status: 'fail', response: error })
        })
      }
    }
  }
</script>
