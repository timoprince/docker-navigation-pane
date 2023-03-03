import api from "../api";
import {METHOD, request} from "@/utils/request";

/**
 * 获取值
 * @param name 名称
 * @returns {Promise<AxiosResponse<T>>}
 */
export function getValue(name) {
    return request(api.sysOptionManage.getValue, METHOD.GET, {name});
}

/**
 * 设置值
 * @param name 名称
 * @param content 内容
 * @returns {Promise<AxiosResponse<T>>}
 */
export function setValue(name, content) {
    return request(api.sysOptionManage.setValue, METHOD.POST, {name, content: JSON.stringify(content)});
}

