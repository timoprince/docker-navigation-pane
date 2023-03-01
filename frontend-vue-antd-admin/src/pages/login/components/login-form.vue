<template>
  <a-form-model ref="form" :model="field" :rules="rules">
    <a-form-model-item prop="account">
      <a-input v-model="field.account" :disabled="submitting" :maxLength="16" allowClear placeholder="请输入账号"
               size="large"></a-input>
    </a-form-model-item>
    <a-form-model-item prop="password">
      <a-input v-model="field.password" :disabled="submitting" :maxLength="16" allowClear placeholder="请输入密码"
               size="large"
               type="password"></a-input>
    </a-form-model-item>
    <a-form-model-item>
      <a-checkbox :checked="remember_me" :disabled="submitting">记住账号</a-checkbox>
    </a-form-model-item>
    <a-form-model-item>
      <a-button :disabled="submitting" :loading="submitting" block size="large" type="primary" @click="handleSubmit">
        {{ submitting ? '登陆中' : '立即登录' }}
      </a-button>
    </a-form-model-item>
  </a-form-model>
</template>

<script>
import {login} from "@/services/user";
import {mapMutations} from "vuex";
import {setAuthorization} from "@/utils/request";

export default {
  name: "login-form",
  data() {
    return {
      remember_me: true,
      submitting: false,
      field: {
        "account": localStorage.getItem(process.env.VUE_APP_ACCOUNT_KEY) || "",
        "password": ""
      },
      rules: {
        "account": [
          {required: true, message: "账号不能为空"}
        ],
        "password": [
          {required: true, message: "账号不能为空"}
        ]
      }
    }
  },
  methods: {
    ...mapMutations('account', ['setRoles', 'setUser']),
    handleSubmit() {
      const {field, remember_me} = this;
      const {account, password} = field;

      this.$refs.form.validate((ok) => {
        if (ok) {
          if (remember_me) localStorage.setItem(process.env.VUE_APP_ACCOUNT_KEY, account);

          this.submitting = true;
          login(account, password).then((res) => {
            const {user_info, token, expire} = res.data;
            this.setUser(user_info);
            if (user_info.role) this.setRoles([{id: user_info.role}]);
            setAuthorization({token, expireAt: new Date().getTime() + expire * 1000});
            this.$emit("finished")
          }).finally(() => {
            this.submitting = false;
          })
        }
      })
    }
  }
}
</script>

<style scoped>

</style>
