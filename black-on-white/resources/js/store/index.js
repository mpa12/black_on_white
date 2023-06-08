import { createStore } from 'vuex';

const store = createStore({
    state() {
        return {
            isLoading: true,
        };
    },
    mutations: {
        setLoading(state, isLoading) {
            state.isLoading = isLoading;
        },
    },
});

export default store;
