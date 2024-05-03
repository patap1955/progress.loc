export default class GosmailReportService {
    getReports(active = 0) {
        return  fetch('/api/get_gosmail_reports' , {
            method: 'GET',
        })
            .then((res) => res.json())
    }
}
