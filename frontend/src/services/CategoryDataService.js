import http from "./http-common"

class CategoryDataService {
    all() {
        return http.get("/categories")
    }
}

export default new CategoryDataService()
