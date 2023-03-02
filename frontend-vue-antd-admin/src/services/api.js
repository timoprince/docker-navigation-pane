const baseUrl = process.env.VUE_APP_API_BASE_URL;

module.exports = {
    account: {
        login: baseUrl + "/admin/account/login"
    },
    sysUserManage: {
        queryListByPage: baseUrl + "/admin/sysUserManage/queryListByPage",
        createRow: baseUrl + '/admin/sysUserManage/createRow',
        updateRow: baseUrl + "/admin/sysUserManage/updateRow",
        deleteRow: baseUrl + '/admin/sysUserManage/deleteRow'
    }

}
