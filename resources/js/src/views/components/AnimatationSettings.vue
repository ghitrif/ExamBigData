<template>
    <li>            
        <h4 style="color:var(--vprimary)">Animations:</h4> 
        <vs-row>
            <vs-col vs-w="4" class="anime_" v-for="(animation,index) in animations" :key="index">
               <div @click="$emit('input', animation.slug);" :class="{activeanim:value==animation.slug}">
                    <span  v-html="animation.icon" style="padding-top: 5px;"></span>
                    <span class="tt" style="padding-bottom: 5px;" >{{animation.name}}</span>
               </div>
            </vs-col>
        </vs-row>
    </li>
</template>
<script>

export default {
  name: "AnimatationSettings",
  props: ["value"],
  data() {
    return {
        animations:[
            {
                name:'Slide down',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><defs><filter id="slide-up-a" width="100%" height="100%" x="0%" y="0%" filterUnits="objectBoundingBox" color-interpolation-filters="sRGB"><feGaussianBlur in="SourceGraphic"></feGaussianBlur></filter></defs><g fill="none" fill-rule="evenodd"><circle cx="25" cy="17" r="14" fill="#2E3246" fill-opacity=".2" filter="url(#slide-up-a)" transform="matrix(-1 0 0 1 50 0)"></circle><circle cx="25" cy="26" r="14" fill="#2E3246" fill-opacity=".8" transform="matrix(-1 0 0 1 50 0)"></circle><path fill="#FFF" d="M23,26 L23,20 L27,20 L27,26 L31,26 L25,33.0673828 L19,26 L23,26 Z"></path></g></svg>',
                slug:'slideInDown'
            },
            {
                name:'Slide up',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><defs><filter id="slide-down-a" width="100%" height="100%" x="0%" y="0%" filterUnits="objectBoundingBox" color-interpolation-filters="sRGB"><feGaussianBlur in="SourceGraphic"></feGaussianBlur></filter></defs><g fill="none" fill-rule="evenodd"><circle cx="25" cy="26" r="14" fill="#2E3246" fill-opacity=".2" filter="url(#slide-down-a)" transform="matrix(-1 0 0 1 50 0)"></circle><circle cx="25" cy="17" r="14" fill="#2E3246" fill-opacity=".8" transform="matrix(-1 0 0 1 50 0)"></circle><path fill="#FFF" d="M27,17 L27,23 L23,23 L23,17 L19,17 L25,9.93261719 L31,17 L27,17 Z"></path></g></svg>',
                slug:'slideInUp'
            },
            
            {
                name:'Slide right',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><defs><filter id="slide-right-a" width="100%" height="100%" x="0%" y="0%" filterUnits="objectBoundingBox" color-interpolation-filters="sRGB"><feGaussianBlur in="SourceGraphic"></feGaussianBlur></filter></defs><g fill="none" fill-rule="evenodd"><circle cx="20" cy="24" r="14" fill="#2E3246" fill-opacity=".2" filter="url(#slide-right-a)"></circle><circle cx="32" cy="24" r="14" fill="#2E3246" fill-opacity=".8"></circle><path fill="#FFF" d="M32,26 L26,26 L26,22 L32,22 L32,18 L39.0673828,24 L32,30 L32,26 Z"></path></g></svg>',
                slug:'slideInRight'
            },
            
            {
                name:'Slide left',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><defs><filter id="slide-left-a" width="100%" height="100%" x="0%" y="0%" filterUnits="objectBoundingBox" color-interpolation-filters="sRGB"><feGaussianBlur in="SourceGraphic"></feGaussianBlur></filter></defs><g fill="none" fill-rule="evenodd"><circle cx="32" cy="24" r="14" fill="#2E3246" fill-opacity=".2" filter="url(#slide-left-a)" transform="matrix(-1 0 0 1 64 0)"></circle><circle cx="20" cy="24" r="14" fill="#2E3246" fill-opacity=".8" transform="matrix(-1 0 0 1 40 0)"></circle><path fill="#FFF" d="M20,22 L26,22 L26,26 L20,26 L20,30 L12.9326172,24 L20,18 L20,22 Z"></path></g></svg>',
                slug:'slideInLeft'
            },
            {
                name:'Blow',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><g fill="#2E3246" fill-rule="evenodd"><circle cx="26" cy="22" r="18" fill-opacity=".2" transform="matrix(1 0 0 -1 0 44)"></circle><circle cx="26" cy="22" r="13" fill-opacity=".4" transform="matrix(1 0 0 -1 0 44)"></circle><circle cx="26" cy="22" r="8" transform="matrix(1 0 0 -1 0 44)"></circle></g></svg>',
                slug:'fadeIn'
            },
            
            {
                name:'Glide',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><defs><filter id="glide-a" width="100%" height="100%" x="0%" y="0%" filterUnits="objectBoundingBox" color-interpolation-filters="sRGB"><feGaussianBlur in="SourceGraphic"></feGaussianBlur></filter><filter id="glide-b" width="100%" height="100%" x="0%" y="0%" filterUnits="objectBoundingBox" color-interpolation-filters="sRGB"><feGaussianBlur in="SourceGraphic"></feGaussianBlur></filter></defs><g fill="none" fill-rule="evenodd"><circle cx="17" cy="25" r="11" fill="#2E3246" fill-opacity=".2" filter="url(#glide-a)"></circle><circle cx="26" cy="25" r="11" fill="#2E3246" fill-opacity=".4" filter="url(#glide-b)"></circle><circle cx="35" cy="25" r="11" fill="#2E3246" fill-opacity=".8"></circle><path fill="#FFF" d="M42,25 L36,30 L36,20 L42,25 Z M36,25 L30,30 L30,20 L36,25 Z"></path></g></svg>',
                slug:'rollIn'
            },
            {
                name:'Elastic',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><defs><filter id="elastic-a" width="100%" height="100%" x="0%" y="0%" filterUnits="objectBoundingBox" color-interpolation-filters="sRGB"><feGaussianBlur in="SourceGraphic"></feGaussianBlur></filter><filter id="elastic-b" width="100%" height="100%" x="0%" y="0%" filterUnits="objectBoundingBox" color-interpolation-filters="sRGB"><feGaussianBlur in="SourceGraphic"></feGaussianBlur></filter></defs><g fill="none" fill-rule="evenodd"><circle cx="25" cy="29" r="11" fill="#2E3246" fill-opacity=".2" filter="url(#elastic-a)" transform="matrix(-1 0 0 1 50 0)"></circle><circle cx="25" cy="22" r="11" fill="#2E3246" fill-opacity=".4" filter="url(#elastic-b)" transform="matrix(-1 0 0 1 50 0)"></circle><circle cx="25" cy="15" r="11" fill="#2E3246" fill-opacity=".8" transform="matrix(-1 0 0 1 50 0)"></circle><path fill="#FFF" d="M25.0280996,14.188623 L20.99278,8.98028963 L28.99278,8.98028963 L25.0280996,14.188623 Z M25.0280996,14.811377 L28.99278,20.0197104 L20.99278,20.0197104 L25.0280996,14.811377 Z"></path></g></svg>',
                slug:'bounceInUp'
            },
            {
                name:'Bounce',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><defs><filter id="bounce-a" width="100%" height="100%" x="0%" y="0%" filterUnits="objectBoundingBox" color-interpolation-filters="sRGB"><feGaussianBlur in="SourceGraphic"></feGaussianBlur></filter><filter id="bounce-b" width="100%" height="100%" x="0%" y="0%" filterUnits="objectBoundingBox" color-interpolation-filters="sRGB"><feGaussianBlur in="SourceGraphic"></feGaussianBlur></filter></defs><g fill="none" fill-rule="evenodd"><circle cx="25" cy="15" r="11" fill="#2E3246" fill-opacity=".2" filter="url(#bounce-a)" transform="matrix(1 0 0 -1 0 30)"></circle><circle cx="25" cy="22" r="11" fill="#2E3246" fill-opacity=".4" filter="url(#bounce-b)" transform="matrix(1 0 0 -1 0 44)"></circle><circle cx="25" cy="29" r="11" fill="#2E3246" fill-opacity=".8" transform="matrix(1 0 0 -1 0 58)"></circle><path fill="#FFF" d="M24.9719004,36.188623 L21.00722,30.9802896 L29.00722,30.9802896 L24.9719004,36.188623 Z M24.9719004,22.811377 L29.00722,28.0197104 L21.00722,28.0197104 L24.9719004,22.811377 Z"></path></g></svg>',
                slug:'bounceInDown'
            },
            {
                name:'Zoom',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><defs><filter id="zoom-a" width="100%" height="100%" x="0%" y="0%" filterUnits="objectBoundingBox" color-interpolation-filters="sRGB"><feGaussianBlur in="SourceGraphic"></feGaussianBlur></filter><filter id="zoom-b" width="100%" height="100%" x="0%" y="0%" filterUnits="objectBoundingBox" color-interpolation-filters="sRGB"><feGaussianBlur in="SourceGraphic"></feGaussianBlur></filter></defs><g fill="none" fill-rule="evenodd"><path fill="#2E3246" fill-opacity=".8" d="M26,38 C16.6111593,38 9,30.3888407 9,21 C9,11.6111593 16.6111593,4 26,4 C35.3888407,4 43,11.6111593 43,21 C43,30.3888407 35.3888407,38 26,38 Z M26,29 C30.418278,29 34,25.418278 34,21 C34,16.581722 30.418278,13 26,13 C21.581722,13 18,16.581722 18,21 C18,25.418278 21.581722,29 26,29 Z"></path><path fill="#FFF" fill-opacity=".4" d="M26,36 C17.7157288,36 11,29.2842712 11,21 C11,12.7157288 17.7157288,6 26,6 C34.2842712,6 41,12.7157288 41,21 C41,29.2842712 34.2842712,36 26,36 Z M26,29 C30.418278,29 34,25.418278 34,21 C34,16.581722 30.418278,13 26,13 C21.581722,13 18,16.581722 18,21 C18,25.418278 21.581722,29 26,29 Z" filter="url(#zoom-a)"></path><path fill="#FFF" fill-opacity=".4" d="M26,33 C19.372583,33 14,27.627417 14,21 C14,14.372583 19.372583,9 26,9 C32.627417,9 38,14.372583 38,21 C38,27.627417 32.627417,33 26,33 Z M26,29 C30.418278,29 34,25.418278 34,21 C34,16.581722 30.418278,13 26,13 C21.581722,13 18,16.581722 18,21 C18,25.418278 21.581722,29 26,29 Z" filter="url(#zoom-b)"></path></g></svg>',
                slug:'zoomIn'
            },
            {
                name:'Roll down',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><g fill="none" fill-rule="evenodd"><rect width="20" height="20" x="16" y="12" fill="#2E3246" fill-opacity=".4" rx="2" transform="scale(-1 1) rotate(60 0 -23.033)"></rect><rect width="20" height="20" x="15" y="8" fill="#2E3246" fill-opacity=".2" rx="2" transform="scale(-1 1) rotate(75 0 -14.58)"></rect><rect width="20" height="20" x="16" y="16" fill="#2E3246" fill-opacity=".8" rx="2" transform="scale(1 -1) rotate(-45 -36.77 0)"></rect><path fill="#FFF" d="M24,26 L24,20 L28,20 L28,26 L32,26 L26,33.0673828 L20,26 L24,26 Z"></path></g></svg>',
                slug:'rotateInDownLeft'
            },
            {
                name:'Roll up',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><defs><rect id="roll-up-a" width="52" height="40"></rect></defs><g fill="none" fill-rule="evenodd"><mask id="roll-up-b" fill="#fff"><rect id="roll-up-a" width="52" height="40"></rect></mask><rect width="20" height="20" x="16" y="14" fill="#2E3246" fill-opacity=".4" mask="url(#roll-up-b)" rx="2" transform="rotate(-120 26 24)"></rect><rect width="20" height="20" x="15" y="18" fill="#2E3246" fill-opacity=".2" mask="url(#roll-up-b)" rx="2" transform="rotate(-105 25 28)"></rect><rect width="20" height="20" x="16" y="10" fill="#2E3246" fill-opacity=".8" mask="url(#roll-up-b)" rx="2" transform="rotate(-45 26 20)"></rect><path fill="#FFF" d="M28,20 L28,26 L24,26 L24,20 L20,20 L26,12.9326172 L32,20 L28,20 Z" mask="url(#roll-up-b)"></path></g></svg>',
                slug:'rotateInUpLeft'
            },
            {
                name:'Flip up',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><g fill="#2E3246" fill-rule="evenodd"><path fill-opacity=".2" d="M18,31 L34,31 C35.6568542,31 37,32.3431458 37,34 L37,40 L15,40 L15,34 C15,32.3431458 16.3431458,31 18,31 Z"></path><path fill-opacity=".8" d="M18,28 C16.3431458,28 15,26.6568542 15,25 L15,9 C15,7.34314575 16.3431458,6 18,6 L34,6 C35.6568542,6 37,7.34314575 37,9 L37,25 C37,26.6568542 35.6568542,28 34,28 L18,28 Z M26,15 L31,9 L21,9 L26,15 Z" transform="matrix(1 0 0 -1 0 34)"></path></g></svg>',
                slug:'flip'
            },
            {
                name:'Flip down',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><g fill="#2E3246" fill-rule="evenodd"><path fill-opacity=".2" d="M18,0 L34,4.4408921e-16 C35.6568542,1.39730022e-16 37,1.34314575 37,3 L37,9 L15,9 L15,3 C15,1.34314575 16.3431458,-1.39730022e-16 18,-4.4408921e-16 Z" transform="rotate(-180 26 4.5)"></path><path fill-opacity=".8" d="M18,34 C16.3431458,34 15,32.6568542 15,31 L15,15 C15,13.3431458 16.3431458,12 18,12 L34,12 C35.6568542,12 37,13.3431458 37,15 L37,31 C37,32.6568542 35.6568542,34 34,34 L18,34 Z M26,21 L31,15 L21,15 L26,21 Z" transform="matrix(-1 0 0 1 52 0)"></path></g></svg>',
                slug:'flipInX'
            },
            {
                name:'Flip right',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><g fill="#2E3246" fill-rule="evenodd"><path fill-opacity=".8" d="M30,37 C28.3431458,37 27,35.6568542 27,34 L27,18 C27,16.3431458 28.3431458,15 30,15 L46,15 C47.6568542,15 49,16.3431458 49,18 L49,34 C49,35.6568542 47.6568542,37 46,37 L30,37 Z M38,24 L43,18 L33,18 L38,24 Z" transform="matrix(0 1 1 0 12 -12)"></path><rect width="22" height="22" x="3" y="15" fill-opacity=".2" rx="3" transform="rotate(90 14 26)"></rect></g></svg>',
                slug:'flipInY'
            },
            {
                name:'Flip left',
                icon:'<svg width="52" height="40" viewBox="0 0 52 40"><g fill="#2E3246" fill-rule="evenodd"><path fill-opacity=".8" d="M3,34 L3,18 C3,16.3431458 4.34314575,15 6,15 L22,15 C23.6568542,15 25,16.3431458 25,18 L25,34 C25,35.6568542 23.6568542,37 22,37 L6,37 C4.34314575,37 3,35.6568542 3,34 Z M16,26 L22,31 L22,21 L16,26 Z"></path><rect width="22" height="22" x="27" y="15" fill-opacity=".2" rx="3" transform="rotate(-90 38 26)"></rect></g></svg>',
                slug:'tada'
            },
            // {
            //     name:'',
            //     icon:'',
            //     slug:''
            // },
        ]
      
    };
  },
}
</script>
<style lang="scss" >
.anime_{
    div{
        border-radius: 4px;
        margin: 6px 4px;
        background: #7367f02e;
        cursor: pointer;
        span{
            display: block;
            width: 100%;
            text-align: center;
            &.tt{            
                font-size: 11px;
            }
        }
        &.activeanim{            
            background: #7367f0;
            color: #fff;
        }
    }

}
</style>