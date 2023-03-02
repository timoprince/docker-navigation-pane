<template>
  <exception-page :home-route="adminUrl" :style="`min-height: ${minHeight}`" type="404" />
</template>

<script>
import ExceptionPage from '@/components/exception/ExceptionPage'
import {mapState} from 'vuex'
export default {
  name: 'Exp404',
  components: {ExceptionPage},
  computed: {
    adminUrl(){
      return process.env.VUE_APP_ADMIN_MAIN;
    },
    ...mapState('setting', ['pageMinHeight']),
    minHeight() {
      return this.pageMinHeight ? this.pageMinHeight + 'px' : '100vh'
    }
  }
}
</script>

<style scoped lang="less">
</style>
