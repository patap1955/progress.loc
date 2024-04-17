export default class BalansService {
    async getBalans() {

        return await fetch('/api/get-balans', {
            method: 'GET',
        })
            .then((res) => res.json())
    }
}
