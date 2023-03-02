<template>
  <page-layout>
    <dialog-form ref="form"></dialog-form>
    <a-card>
      <a-row :gutter="[15,15]">
        <a-col :span="24">
          <a-button type="primary" icon="plus" @click="$refs.form.show(null)">添加</a-button>
        </a-col>
        <a-col :span="24">
          <a-table></a-table>
        </a-col>
      </a-row>
    </a-card>
  </page-layout>
</template>

<script>
import PageLayout from "@/layouts/PageLayout.vue";
import DialogForm from "@/pages/system/SysUserManage/components/dialog-form.vue";

export default {
  name: "SysUserManage",
  components: {DialogForm, PageLayout}
}
</script>

<style scoped>

</style>
