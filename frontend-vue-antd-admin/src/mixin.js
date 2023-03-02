import Vue from "vue";

Vue.mixin({
    methods: {
        /**
         * 拷贝一份表单字段
         * @param field 表单字段
         * @returns {any}
         */
        copyField(field) {
            return JSON.parse(JSON.stringify(field));
        }
    }
})
