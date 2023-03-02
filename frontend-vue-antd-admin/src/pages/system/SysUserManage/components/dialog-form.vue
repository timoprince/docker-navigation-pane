<template>
  <a-modal :footer="null" :title="title" :visible="visible" width="520px" @cancel="hide">
    <a-form-model ref="form" v-trim :model="field" :rules="rules" class="flex-form label-6em">
      <a-form-model-item label="头像" prop="avatar">
        <upload-image v-model="field.avatar"></upload-image>
      </a-form-model-item>
      <a-form-model-item label="账号" prop="account">
        <a-input v-model="field.account" :allowClear="true" :maxLength="16" placeholder="请输入账号"></a-input>
      </a-form-model-item>
      <a-form-model-item label="密码" prop="password">
        <a-input v-model="field.password" :allowClear="true" :maxLength="16" placeholder="请输入密码"
                 type="password"></a-input>
      </a-form-model-item>
      <a-form-model-item label="确认密码" prop="confirm_password">
        <a-input v-model="field.confirm_password" :allowClear="true" :maxLength="16" placeholder="确认一遍密码"
                 type="password"></a-input>
      </a-form-model-item>
      <a-form-model-item label="用户名" prop="name">
        <a-input v-model="field.name" :allowClear="true" :maxLength="16" placeholder="请输入账号"></a-input>
      </a-form-model-item>
      <a-form-model-item label="分配角色" prop="role">
        <a-radio-group v-model="field.role" :options="optionRoles"></a-radio-group>
      </a-form-model-item>
      <a-form-model-item class="flex-form-footer">
        <a-space>
          <a-button icon="check" type="primary" @click="handleSubmit">保存</a-button>
          <a-button icon="reload" @click="resetFields">重新填写</a-button>
        </a-space>
      </a-form-model-item>
    </a-form-model>
  </a-modal>
</template>

<script>

import {optionRoles} from "@/pages/system/SysUserManage/options";
import UploadImage from "@/components/upload/upload-image.vue";

function resetField() {
  return {
    "account": "",
    "password": "",
    "name": "",
    "avatar": "",
    "role": "",
    "confirm_password": ""
  }
}

export default {
  name: "dialog-form",
  components: {UploadImage},
  data() {
    return {
      optionRoles,
      field: resetField(),
      visible: false,
      rules: {},
      labelCol: {
        style: {
          width: "6em"
        }
      },
      wrapperCol: {
        style: {
          width: "auto"
        }
      }
    }
  },
  computed: {
    title() {
      const {field} = this;

      return field.id ? '修改用户' : '添加用户'
    }
  },
  methods: {
    show(field) {
      if (field) this.field = this.copyFields(field);
      this.visible = true;
    },
    hide() {
      this.field = resetField();
      this.$refs.form.clearValidate();
      this.visible = false;
    },
    resetFields() {
      const {form} = this.$refs;
      form.clearValidate();
      form.resetFields();
    },
    handleSubmit() {
      this.$refs.form.validate((ok) => {
        if (ok) {
          const field = this.copyFields(this.field);
          console.table(field);
        }
      })
    }
  }
}
</script>

<style scoped>

</style>
