import http from "./http-common"

class ArticleDataService {
    all(searchTitle, page, perPage, category) {
        let params = this.getRequestParams(searchTitle, page, perPage, category)
        return http.get("/articles", {params})
    }

    upload(file) {
        return http.post("/articles/upload", file)
    }

    getRequestParams(searchTitle, page, perPage, category) {
        let params = {}

        if (searchTitle) {
            params['search'] = searchTitle
        }

        if (page) {
            params['page'] = page
        }

        if (perPage) {
            params['perPage'] = perPage
        }

        if (category) {
            params['category'] = category
        }

        return params
    }
}

export default new ArticleDataService()
