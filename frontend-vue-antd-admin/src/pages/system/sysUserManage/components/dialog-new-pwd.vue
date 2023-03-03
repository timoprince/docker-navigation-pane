<template>
  <a-modal :destroyOnClose="true" :footer="null" :forceRender="true" :maskClosable="false" :visible="visible"
           title="修改密码" width="520px" @cancel="hide">
    <a-form-model ref="form" v-trim :model="field" :rules="rules" class="flex-form label-8em">

      <a-form-model-item label="新密码" prop="password">
        <a-input v-model="field.password" :allowClear="true" :maxLength="16" placeholder="请输入密码"
                 type="password"></a-input>
      </a-form-model-item>
      <a-form-model-item label="确认新密码" prop="confirm_password">
        <a-input v-model="field.confirm_password" :allowClear="true" :maxLength="16" placeholder="确认一遍密码"
                 type="password"></a-input>
      </a-form-model-item>
      <a-form-model-item class="flex-form-footer">
        <a-space>
          <a-button icon="check" type="primary" @click="handleSubmit">确认更换</a-button>
        </a-space>
      </a-form-model-item>
    </a-form-model>
  </a-modal>
</template>

<script>
import {optionRoles, resetField} from "@/pages/system/sysUserManage/options";
import {updateRow} from "@/services/src/sysUserManage";


export default {
  name: "dialog-new-pwd",
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
        "password": [
          {required: true, message: "账号不能为空"}
        ],
        "confirm_password": [
          {required: true, message: "确认密码是必填项"},
          {validator: validateConfirmPwd}
        ]
      }
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
          const {password} = field;

          updateRow(field.id, field).then(() => {
            this.$message.success({
              content: this.$createElement("span", {
                domProps: {
                  innerHTML: `密码已修改！新密码：<b style="color: red;">${password}</b>，请牢记您的新密码！`
                }
              })
            })
            this.hide();
            this.$emit("finished", field);
          });
        }
      })
    },
  }
}
</script>

<style scoped>

</style>
