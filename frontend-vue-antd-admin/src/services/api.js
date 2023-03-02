const baseUrl = process.env.VUE_APP_API_BASE_URL;

module.exports = {
    account: {
        login: baseUrl + "/admin/account/login"
    }
}
