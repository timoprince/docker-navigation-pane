<template>
  <page-layout>
    <dialog-new-pwd ref="new-pwd" @finished="handleReload"></dialog-new-pwd>
    <dialog-form ref="form" @finished="handleReload"></dialog-form>
    <a-card>
      <a-row :gutter="[15,15]">
        <a-col :span="24">
          <a-space>
            <a-form-model layout="inline">
              <a-form-model-item label="用户名">
                <a-input v-model="field.name" :allowClear="true" :maxLength="16" placeholder="根据用户名过滤"></a-input>
              </a-form-model-item>
              <a-form-model-item>
                <a-space>
                  <a-button icon="search" @click="handleSearch">搜索</a-button>
                </a-space>
              </a-form-model-item>
            </a-form-model>
          </a-space>
        </a-col>
        <a-col :span="24">
          <a-space>
            <a-button icon="plus" type="primary" @click="$refs.form.show(null)">添加</a-button>
            <a-button icon="reload" @click="handleReload">刷新</a-button>
          </a-space>
        </a-col>
        <a-col :span="24">
          <a-table :columns="tableColumns" :dataSource="tableData" :loading="false" :total="total"
                   rowKey="id">
            <template slot="avatar" slot-scope="url">
              <a-avatar :size="32" :src="url" icon="user"></a-avatar>
            </template>
            <template slot="format-time" slot-scope="time">
              {{ time | formatTime }}
            </template>
            <template slot="action" slot-scope="row">
              <a-space>
                <a-button icon="edit" size="small" @click="$refs.form.show(row)">修改</a-button>
                <a-button icon="close" size="small">删除</a-button>
                <a-dropdown placement="bottomRight">
                  <a-menu slot="overlay" @click="({key})=>handleMenuClick('setting',key,row)">
                    <a-menu-item key="resetPwd">重置密码</a-menu-item>
                    <a-menu-item key="resetAvatar">重置头像</a-menu-item>
                    <a-menu-item key="changePwd">更换密码</a-menu-item>
                  </a-menu>
                  <a-button icon="setting" size="small">
                    <span>更多</span>
                    <a-icon type="down"/>
                  </a-button>
                </a-dropdown>
              </a-space>
            </template>
          </a-table>
        </a-col>
      </a-row>
    </a-card>
  </page-layout>
</template>

<script>
import PageLayout from "@/layouts/PageLayout.vue";
import DialogForm from "@/pages/system/sysUserManage/components/dialog-form.vue";
import {queryListByPage, updateRow} from "@/services/sysUserManage";
import {tableColumns} from "@/pages/system/sysUserManage/options";
import DialogNewPwd from "@/pages/system/sysUserManage/components/dialog-new-pwd.vue";

export default {
  name: "sysUserManage",
  components: {DialogNewPwd, DialogForm, PageLayout},
  data() {
    return {
      tableColumns,
      field: {
        page_size: 10,
        page_num: 1,
        name: null
      },
      total: 0,
      tableData: []
    }
  },
  created() {
    this.handleReload();
  },
  methods: {
    handleSearch() {
      this.total = 0;
      this.tableData = [];
      this.field.page_num = 1;
      this.field.page_size = 10;
      this.handleReload();
    },
    handleReload() {
      queryListByPage(this.field).then((res) => {
        const {total, data} = res.data;
        this.total = total;
        this.tableData = data;
      })
    },
    handleMenuClick(type, key, row) {
      if (type === "setting") {
        switch (key) {
          case "resetPwd":
            this.handleResetPwd(row);
            break;
          case "resetAvatar":
            this.handleResetAvatar(row);
            break;
          case "changePwd":
            this.$refs["new-pwd"].show(row);
            break;
          default:
            console.log(key);
            break;
        }
      }
    },
    handleResetPwd(row) {
      const newPwd = this.randomNumber(100000, 999999).toString();
      const field = this.copyFields(row);
      field.password = newPwd;
      updateRow(field.id, field).then(() => {
        this.$message.success({
          content: this.$createElement("span", {
            domProps: {
              innerHTML: `密码已重置！新密码：<b style="color: red;">${newPwd}</b>`
            }
          })
        })
        this.handleReload();
      })
    },
    handleResetAvatar(row) {
      const field = this.copyFields(row);
      field.avatar = null;
      updateRow(row.id, field).then(() => {
        this.$message.success("头像已重置！")
        this.handleReload();
      })
    }
  }
}
</script>

<style scoped>

</style>
