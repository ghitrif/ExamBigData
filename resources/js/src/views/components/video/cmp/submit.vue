<template>
    <button type="submit" name="button" class="vs-component vs-button vs-button-primary vs-button-filled" style="float: right; border-radius: 20px;"><span class="vs-button-backgroundx vs-button--background" style="opacity: 1; left: 41px; top: 13px; width: 0px; height: 0px; transition: width 0s ease 0s, height 0s ease 0s, opacity 0s ease 0s;"></span><!----><span class="vs-button-text vs-button--text">{{label}}</span><span class="vs-button-linex" style="top: auto; bottom: -2px; left: 50%; transform: translate(-50%);"></span></button>
</template>

<script>

export default {
  props: ["text"], 
  computed: {
      label: function(){
          if(!this.text)
            return 'Save'
        return this.text
      },
      
  },
};
</script>