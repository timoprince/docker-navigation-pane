export const optionRoles = [
    {
        label: "普通用户",
        value: ""
    },
    {
        label: "管理员",
        value: "admin"
    }
]

export const tableColumns = [
    {
        dataIndex: "id",
        align: "center",
        ellipsis: true,
        fixed: "left",
        title: "ID",
        width: 100
    },
    {
        dataIndex: "avatar",
        align: "center",
        ellipsis: true,
        title: "头像",
        width: 100,
        scopedSlots: {customRender: 'avatar'}
    },
    {
        dataIndex: "name",
        align: "center",
        ellipsis: true,
        title: "用户名",
        width: 200
    },
    {
        dataIndex: "account",
        align: "center",
        ellipsis: true,
        title: "登录账号",
        width: 200
    },
    {
        dataIndex: "role",
        align: "center",
        ellipsis: true,
        title: "用户名",
        width: 200,
        customRender: (value) => {
            for (const role of optionRoles) {
                if (role.value === value) {
                    return role.label;
                }
            }
            return "普通用户";
        }
    },
    {
        dataIndex: "create_time",
        align: "center",
        ellipsis: true,
        title: "创建时间",
        width: 200,
        scopedSlots: {customRender: 'format-time'}
    },
    {
        dataIndex: "update_time",
        align: "center",
        ellipsis: true,
        title: "最后修改时间",
        width: 200,
        scopedSlots: {customRender: 'format-time'}
    },
    {
        align: "center",
        ellipsis: true,
        title: "操作",
        fixed: "right",
        width: 300,
        scopedSlots: {customRender: 'action'}
    }
]

export function resetField() {
    return {
        "account": "",
        "password": "",
        "name": "",
        "avatar": "",
        "role": "",
        "confirm_password": ""
    }
}
