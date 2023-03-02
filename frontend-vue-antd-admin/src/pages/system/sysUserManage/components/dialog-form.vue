<template>
  <a-modal :destroyOnClose="true" :footer="null" :forceRender="true" :maskClosable="false" :title="title"
           :visible="visible" width="520px" @cancel="hide">
    <a-form-model ref="form" v-trim :model="field" :rules="rules" class="flex-form label-6em">
      <a-form-model-item label="头像" prop="avatar">
        <upload-image v-model="field.avatar"></upload-image>
      </a-form-model-item>
      <a-form-model-item label="账号" prop="account">
        <a-input v-model="field.account" :allowClear="true" :maxLength="16" placeholder="请输入账号"></a-input>
      </a-form-model-item>
      <template v-if="!field.id">
        <a-form-model-item label="密码" prop="password">
          <a-input v-model="field.password" :allowClear="true" :maxLength="16" placeholder="请输入密码"
                   type="password"></a-input>
        </a-form-model-item>
        <a-form-model-item label="确认密码" prop="confirm_password">
          <a-input v-model="field.confirm_password" :allowClear="true" :maxLength="16" placeholder="确认一遍密码"
                   type="password"></a-input>
        </a-form-model-item>
      </template>
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

import {optionRoles, resetField} from "@/pages/system/sysUserManage/options";
import UploadImage from "@/components/upload/upload-image.vue";
import {createRow, updateRow} from "@/services/sysUserManage";

export default {
  name: "dialog-form",
  components: {UploadImage},
  data() {
    const field = resetField();

    function validateConfirmPwd(rules, value, callback) {
      if (field.confirm_password !== field.password) {
        callback('两次输入的密码不一致！');
      } else {
        callback()
      }
    }

    return {
      optionRoles,
      field,
      visible: false,
      rules: {
        "account": [
          {required: true, message: "账号不能为空"}
        ],
        "password": [
          {required: true, message: "账号不能为空"}
        ],
        "name": [
          {required: true, message: "用户名不能为空"}
        ],
        "role": [
          {required: true, message: "角色是必选项"}
        ],
        "confirm_password": [
          {required: true, message: "确认密码是必填项"},
          {validator: validateConfirmPwd}
        ]
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

          const request = field.id ? updateRow(field.id, field) : createRow(field);

          if (request instanceof Promise) {
            request.then(() => {
              this.hide();
              this.$emit("finished", field);
            });
          }
        }
      })
    },
  }
}
</script>

<style scoped>

</style>
