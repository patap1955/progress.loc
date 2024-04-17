export default class ReportDocService {
    getDocs() {
        return fetch('/api/report-docs', {
            method: 'GET',
        })
            .then((res) => res.json())
    }
}
