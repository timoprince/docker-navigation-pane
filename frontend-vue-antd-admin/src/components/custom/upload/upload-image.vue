<template>
  <a-upload
      :action="uploadApi"
      :before-upload="beforeUpload"
      :show-upload-list="false"
      class="upload-image"
      list-type="picture-card"
      name="file"
      @change="handleChange"
  >
    <img v-if="imageUrl" :src="imageUrl" alt="avatar"/>
    <div v-else>
      <a-icon :type="loading ? 'loading' : 'plus'"/>
      <div class="ant-upload-text">
        {{ placeholder }}
      </div>
    </div>
  </a-upload>
</template>

<script>
function getBase64(img, callback) {
  const reader = new FileReader();
  reader.addEventListener('load', () => callback(reader.result));
  reader.readAsDataURL(img);
}

export default {
  name: "upload-image",
  data() {
    return {
      loading: false,
      imageUrl: '',
    };
  },
  watch: {
    value: {
      immediate: true,
      handler(value) {
        this.imageUrl = value;
      }
    }
  },
  methods: {
    handleChange(info) {
      if (info.file.status === 'uploading') {
        this.loading = true;
        return;
      }
      if (info.file.status === 'done') {
        const {response, originFileObj} = info.file;

        if (response.code === 0) {
          getBase64(originFileObj, (base64) => {
            this.imageUrl = base64;
            this.loading = false;
            this.$emit("input", response.data.url);
          })
        }
      }
    },
    beforeUpload(file) {
      const {size, name} = file;
      const ext = name.replace(/^.+\./, "");
      const {allowExt, allowSizeLimit} = this;

      if (!allowExt.includes(ext)) {
        this.$message.info("不支持的图片格式！")
        return false;
      }

      if (size > allowSizeLimit) {
        this.$message.info("上传图片过大，请压缩后重新上传！");
        return false;
      }

      return true;
    },
  },
  props: {
    placeholder: {
      type: String,
      default() {
        return "点击上传"
      }
    },
    value: {
      type: String,
      default() {
        return ""
      }
    },
    uploadApi: {
      type: String,
      default() {
        return process.env.VUE_APP_API_UPLOAD_API;
      }
    },
    allowSizeLimit: {
      type: Number,
      default() {
        // 默认2M
        return 1024 * 1024 * 2;
      }
    },
    allowExt: {
      type: Array,
      default() {
        return ["jpg", "jpeg", "png", "svg", "webp"]
      }
    }
  }
}
</script>

<style lang="less">
.upload-image {
  --upload-size: 120px;

  .ant-upload {
    width: var(--upload-size);
    height: var(--upload-size);
  }

  .ant-upload-select-picture-card {
    i {
      font-size: 32px;
      color: #999;
    }

    .ant-upload-text {
      margin-top: 8px;
      color: #666;
    }

    .ant-upload {
      img {
        width: 100%;
        height: 100%;
        object-fit: contain;
      }
    }
  }
}
</style>
