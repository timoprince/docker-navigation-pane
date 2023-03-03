import api from "../api";
import {METHOD, request} from "@/utils/request";
import md5 from "js-md5";

/**
 * 分页查询列表
 * @param params 查询参数
 * @returns {Promise<AxiosResponse<T>>}
 */
export async function queryListByPage(params) {
    return request(api.sysUserManage.queryListByPage, METHOD.GET, params);
}

/**
 * 创建行数据
 * @param field 表单数据
 * @returns {Promise<AxiosResponse<T>>}
 */
export async function createRow(field) {
    delete field.confirm_password;
    field.password = md5(field.password);
    return request(api.sysUserManage.createRow, METHOD.POST, field);
}

/**
 * 更新行数据
 * @param id 行id
 * @param field 表单数据
 * @returns {Promise<AxiosResponse<T>>}
 */
export async function updateRow(id, field) {
    if (field.password) {
        delete field.confirm_password;
        field.password = md5(field.password);
    }
    field.id = id;
    return request(api.sysUserManage.updateRow, METHOD.POST, field);
}

/**
 * 删除行数据
 * @param id 行id
 * @returns {Promise<AxiosResponse<T>>}
 */
export async function deleteRow(id) {
    return request(api.sysUserManage.deleteRow, METHOD.POST, {id});
}
