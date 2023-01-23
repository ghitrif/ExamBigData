<template>
    <div class="tab_settings BrandingSettings">
        <span class="title">Security</span>
        <li>
            <label for="">Enable passcode</label>
            <vs-switch v-model="video.funnel.enablePasscode"/>
        </li>               
       
        <li>                              
            <div class=" form-group">
                <label>Passcode</label>
                <input v-model="video.funnel.passcode" type="text" class="form-control" placeholder="passcode">
            </div>
        </li>
    </div>
</template>
<script>
export default {
  props: ['video'],
  data() {
    return {
    };
  },
  components: {
  },
  computed: {},
  methods: {
  },
  async mounted() {
  },
};
</script>