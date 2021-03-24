<template>
  <div class="background" @click="$emit('click-event')"></div>
</template>

<script>
export default {
  created() {
    document.body.style.overflow = "hidden";
    document.body.style.touchAction = "none";
    document.body.style['-ms-touch-action'] = "none";
    document.body.style.position = "relative";
    document.body.style.height = "100%";
  },
  destroyed() {
    document.body.removeAttribute("style");
  }
}
</script>

<style scoped>
.background {
    position: fixed;
    top:0;
    left:0;
    background-color: rgba(0,0,0,0.2);
    width:100%;
    height: 100vh;
    z-index: 5;
}
</style>
