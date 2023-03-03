<template>
  <div class="tag-input">
    <template v-for="(tag, index) in tags">
      <a-tooltip v-if="tag.length > 20" :key="tag" :title="tag">
        <a-tag :key="tag" :closable="index !== 0" @close="() => handleClose(tag)">
          {{ `${tag.slice(0, 20)}...` }}
        </a-tag>
      </a-tooltip>
      <a-tag v-else :key="tag" :closable="index !== 0" @close="() => handleClose(tag)">
        {{ tag }}
      </a-tag>
    </template>
    <a-input
        v-if="inputVisible"
        ref="input"
        :placeholder="placeholder"
        :style="{ width: '78px' }"
        :value="inputValue"
        size="small"
        type="text"
        @blur="handleInputConfirm"
        @change="handleInputChange"
        @keyup.enter="handleInputConfirm"
    />
    <a-tag v-else style="background: #fff; borderStyle: dashed;" @click="showInput">
      <a-icon type="plus"/>
      <span style="margin-left: 5px;">{{ text }}</span>
    </a-tag>
  </div>
</template>

<script>
export default {
  name: "tag-input",
  data() {
    return {
      tags: [],
      inputVisible: false,
      inputValue: '',
    };
  },
  watch: {
    value: {
      immediate: true,
      handler(value) {
        this.tags = value;
      }
    }
  },
  methods: {
    handleClose(removedTag) {
      this.tags = this.tags.filter(tag => tag !== removedTag);
    },
    showInput() {
      this.inputVisible = true;
      this.$nextTick(() => {
        this.$refs.input.focus();
      });
    },
    handleInputChange(e) {
      this.inputValue = e.target.value;
    },
    handleInputConfirm() {
      const inputValue = this.inputValue;
      let tags = this.tags;
      if (inputValue && tags.indexOf(inputValue) === -1) {
        tags = [...tags, inputValue];
      }
      Object.assign(this, {
        tags,
        inputVisible: false,
        inputValue: '',
      });
    },
  },
  props: {
    text: {
      type: String,
      default() {
        return "添加"
      }
    },
    placeholder: {
      type: String,
      default() {
        return "请输入"
      }
    },
    value: {
      type: Array,
      default() {
        return []
      }
    },
  }
}
</script>

<style scoped>

</style>
