<template>
  <a-modal :footer="null" :title="title" :visible="visible" width="720px">
    <a-form-model class="flex-form label-4em" :model="field" :rules="rules">
      <a-form-model-item label="账号" prop="account">
        <a-input v-model="field.account" :allowClear="true" :maxLength="16" placeholder="请输入账号"></a-input>
      </a-form-model-item>
    </a-form-model>
  </a-modal>
</template>

<script>

function resetField() {
  return {
    "account": "",
    "password": "",
    "name": "",
    "avatar": "",
    "role": ""
  }
}

export default {
  name: "dialog-form",
  data() {
    return {
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
      if (field) this.field = this.copyField(field);
      this.visible = true;
    }
  }
}
</script>

<style scoped>

</style>
