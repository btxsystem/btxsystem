const state = {
  ebooks: []
}

const getters = {
  getEbooks: (state) => state.ebooks
}

const actions = {
  FETCH_EBOOK: ({commit}, url) => {
    return axios.get(url)
      .then(res => {
        commit('SET_EBOOK', res.data.data)
        return res.data
      })
      .catch(err => {
        return err
      })
  }
}

const mutations = {
  SET_EBOOK: (state, value) => (state.ebooks = value)
}

export default {
  state,
  getters,
  actions,
  mutations
}