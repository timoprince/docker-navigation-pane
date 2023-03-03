<template>
  <page-layout>
    <a-card>
      <a-tabs v-model="activeTabIndex">
        <a-tab-pane key="template_variable" tab="模板变量">
          <config-template-variable></config-template-variable>
        </a-tab-pane>
      </a-tabs>
    </a-card>
  </page-layout>
</template>

<script>
import PageLayout from "@/layouts/PageLayout.vue";
import ConfigTemplateVariable from "@/pages/system/sysOptionManage/components/config-template-variable.vue";

export default {
  name: "sysOptionManage",
  components: {ConfigTemplateVariable, PageLayout},
  data() {
    return {
      activeTabIndex: "template_variable"
    }
  }
}
</script>

<style scoped>

</style>
