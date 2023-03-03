<template>
  <a-form-model ref="form" :model="field" :rules="rules" class="flex-form label-8em">
    <a-row :gutter="[15,15]">
      <a-col :span="16">
        <a-form-model-item label="站点标题">
          <a-input v-model="field.head_title" :allowClear="true" :maxLength="16" placeholder="设置标题"></a-input>
        </a-form-model-item>
        <a-form-model-item label="站点介绍">
          <a-input type="textarea" v-model="field.meta_description" :allowClear="true" :maxLength="500" placeholder="设置标题"></a-input>
        </a-form-model-item>
        <a-form-model-item label="站点关键词">
          <tag-input v-model="field.meta_keywords" placeholder="关键词"></tag-input>
        </a-form-model-item>
      </a-col>
      <a-col :span="8">
        <a-form-model-item label="站点图标">
          <upload-image v-model="field.url_favicon"></upload-image>
        </a-form-model-item>
        <a-form-model-item label="站点Logo">
          <a-space>
            <a-tooltip title="默认Logo">
              <upload-image v-model="field.url_logo"></upload-image>
            </a-tooltip>
            <a-tooltip title="反色Logo">
              <upload-image v-model="field.url_logo_reverse"></upload-image>
            </a-tooltip>
          </a-space>
        </a-form-model-item>
      </a-col>
      <a-col :span="24">
        <a-form-model-item class="flex-form-footer">
          <a-space>
            <a-button icon="check" type="primary" @click="handleSubmit">保存</a-button>
          </a-space>
        </a-form-model-item>
      </a-col>
    </a-row>
  </a-form-model>
</template>

<script>
import TagInput from "@/components/custom/form/tag-input.vue";
import UploadImage from "@/components/custom/upload/upload-image.vue";
import {getValue, setValue} from "@/services/src/sysOptionManage";

function defaultField() {
  return {
    head_title: "",
    meta_keywords: [],
    meta_description: "",
    url_favicon: "",
    url_logo: "",
    url_logo_reverse: ""
  }
}

export default {
  name: "config-template-variable",
  components: {UploadImage, TagInput},
  data() {
    const field = defaultField();

    return {
      field,
      rules: {}
    }
  },
  created() {
    getValue("template_variable").then((res)=>{
      const {content} = res.data;
      if(content) this.field = JSON.parse(content);
    })
  },
  methods: {
    handleSubmit() {
      this.$refs.form.validate((ok) => {
        if (ok) {
          setValue("template_variable",this.field).then(()=>{
            this.$message.success("保存成功！")
          })
        }
      })
    }
  }
}
</script>

<style scoped>

</style>
