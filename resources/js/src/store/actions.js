import Axios from 'axios'
const axios = Axios.create({
    baseURL: "/",
    headers: {
        // "Content-Type": "application/x-www-form-urlencoded"
    },
    responseType: "json"
});

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {

    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

const actions = {
    login({ commit }, user) {
        return new Promise((resolve, reject) => {
            axios({ url: '/login', data: user, method: 'POST' })
                .then(resp => {

                    resolve(resp)
                    localStorage.setItem('authorization', resp.data.token)

                    commit('setUser', resp.data.user)
                    commit('setToken', resp.data.token)
                        // window.location.href = "/"
                        // return res
                })
                .catch(err => {
                    localStorage.removeItem('token')
                    reject(err)
                })
        })
    },




    async UpdatePRofile({ commit }, profile) {
        let res = await axios.post('/account', profile)
        return res.data
    },
    async GetProfile() {
        let res = await axios.get('/account')
        return res.data
    },


    async loadMedia() {
        let res = await axios.get('/media')
        return res.data
    },

    async getVimeoLinks({ commit }, url) {
        let res = await axios.post('/getVimeoVideoLinks', { url: url })
        return res.data
    },
    async getYoutubeLinks({ commit }, url) {
        let res = await axios.post('/getYoutubeVideoLinks', { url: url })
        return res.data
    },
    

    async RenameMedia({ commit }, media) {
        let res = await axios.post('/medias/rename', media)
        return res.data
    },
    async loadImages() {
        let res = await axios.get('/medias/image')
        return res.data
    },
    async deleteMedia({ commit }, media) {
        let res = await axios.delete('/media/' + media.id)
        return res.data
    },
    async InviteUser({ commit }, user) {
        let res = await axios.post('/users/invite', user)
        return res.data
    },
    async GetTeamUsers() {
        let res = await axios.get('/users/team')
        return res.data
    },
    async CreateUser({ commit }, user) {
        let res = await axios.post('/user', user)
        return res.data
    },
    async DeleteUser({ commit }, user) {
        let res = await axios.delete('/user/' + user.id)
        return res.data
    },
    async EditUser({ commit }, user) {
        let res = await axios.post('/user/update',user)
        return res.data
    },
    async getUser({ commit }, user) {
        let res = await axios.get('/user/' + user.id)
        return res.data
    },
    async getUsers() {
        let res = await axios.get('/user')
        return res.data
    },



    async verifySMTP({ commit }, brand) {
        let res = await axios.post('/brand/verifySMTP', brand)
        return res.data
    },
    async createSmtpEmail({ commit }, smtp) {
        let res = await axios.post('/SmtpEmail/create', smtp)
        return res.data
    },
    async LoadSmtpEmail() {
        let res = await axios.get('/SmtpEmail/get')
        return res.data
    },
    
    async getBrand() {
        let res = await axios.get('/brand')
        return res.data
    },
    async createBrand({ commit }, brand) {
        let res = await axios.post('/brand', brand)
        return res.data
    },
    
    async configBrandCourse({ commit }, brand) {
        let res = await axios.post('/brand/setupDomain', brand)
        return res.data
    },
    async getStats_global({ commit }) {
        let res = await axios.get('/stats/global')
        return res.data
    },
    async getPayments({ commit }) {
        let res = await axios.get('/payment')
        return res.data
    },

    // integration 
    async LoadIntegration({ commit }) {
        let res = await axios.get('/integration')
        return res.data
    },
    async AddIntegration({ commit }, integration) {
        let res = await axios.post('/integrations/' + integration.name, integration)
        return res.data
    },
    async DeleteIntegration({ commit }, integration) {
        let res = await axios.post('/integration/delete', integration)
        return res.data
    },


    // Vertical NavMenu
    updateVerticalNavMenuWidth({ commit }, width) {
        commit('UPDATE_VERTICAL_NAV_MENU_WIDTH', width)
    },

    // VxAutoSuggest
    updateStarredPage({ commit }, payload) {
        commit('UPDATE_STARRED_PAGE', payload)
    },

    // The Navbar
    arrangeStarredPagesLimited({ commit }, list) {
        commit('ARRANGE_STARRED_PAGES_LIMITED', list)
    },
    arrangeStarredPagesMore({ commit }, list) {
        commit('ARRANGE_STARRED_PAGES_MORE', list)
    },

    // /////////////////////////////////////////////
    // UI
    // /////////////////////////////////////////////

    toggleContentOverlay({ commit }) {
        commit('TOGGLE_CONTENT_OVERLAY')
    },
    updateTheme({ commit }, val) {
        commit('UPDATE_THEME', val)
    },

    // /////////////////////////////////////////////
    // User/Account
    // /////////////////////////////////////////////

    updateUserInfo({ commit }, payload) {
        commit('UPDATE_USER_INFO', payload)
    }
}

export default actions