import Vue from "vue";
import moment from "moment";

Vue.mixin({
    methods: {
        /**
         * 拷贝一份表单字段
         * @param field 表单字段
         * @returns {any}
         */
        copyFields(field) {
            return JSON.parse(JSON.stringify(field));
        },
        /**
         * 随机数（整数，含最小值，不含最大值）
         * @param min 最小值
         * @param max 最大值
         * @returns {number}
         */
        randomNumber(min = 0, max = 999999999) {
            return Math.floor(Math.random() * (max - min) + min);
        }
    },
    filters: {
        /**
         * 格式化时间戳
         * @param time 时间
         * @param format 目标格式
         * @returns {*|string}
         */
        formatTime(time, format = "YYYY年MM月DD日 HH:mm:ss") {
            if (!time) return time;
            return moment(time).format(format);
        }
    }
    ,
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
