import Vue from "vue";

Vue.mixin({
    methods: {
        /**
         * 拷贝一份表单字段
         * @param field 表单字段
         * @returns {any}
         */
        copyFields(field) {
            return JSON.parse(JSON.stringify(field));
        }
    },
    directives: {
        /**
         * 去头尾空格
         * @param elem
         */
        trim(elem) {
            elem.querySelectorAll("input,textarea").forEach((el) => {
                el.addEventListener("blur", () => {
                    el.value = el.value.replace(/^\s+|\s+$/, "");
                })
            })
        }
    }
})
