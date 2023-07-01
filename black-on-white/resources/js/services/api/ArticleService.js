import axios from 'axios';

class ArticleService {
    static indexUrl = '/api/article';
    static getShowUrl = id => `/api/article/${id}`;

    static indexResponseHandler = (response, articles) => {
        return {
            articles: [...articles, ...response.data['data']],
            totalPages: response.data['meta'].last_page,
        };
    };

    static async index(page, searchText, selectedFilters, currentArticles){
        let params = { page };
        if (searchText !== '') params['text'] = searchText;
        if (selectedFilters.length > 0) params['article_type'] = selectedFilters.join(',');

        return axios.get(this.indexUrl, { params }).then(
            response => this.indexResponseHandler(response, currentArticles)
        );
    };

    static showResponseHandler = response => response.data['data'];

    static async show(articleId) {
        const url = this.getShowUrl(articleId);
        return axios.get(url).then(this.showResponseHandler);
    };
}

export default ArticleService;
