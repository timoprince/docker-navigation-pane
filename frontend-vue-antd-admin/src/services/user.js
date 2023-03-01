import api from "./api";
import {request, METHOD, removeAuthorization} from '@/utils/request'
import md5 from "js-md5";

/**
 * 登录服务
 * @param account 账号
 * @param password 密码
 * @returns {Promise<AxiosResponse<T>>}
 */
export async function login(account, password) {
  return request(api.account.login, METHOD.POST, {
    account: account,
    password: md5(password)
  })
}

/**
 * 退出登录
 */
export function logout() {
  localStorage.removeItem(process.env.VUE_APP_ROUTES_KEY)
  localStorage.removeItem(process.env.VUE_APP_PERMISSIONS_KEY)
  localStorage.removeItem(process.env.VUE_APP_ROLES_KEY)
  removeAuthorization()
}
export default {
  login,
  logout
}
