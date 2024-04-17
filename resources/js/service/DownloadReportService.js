import axios from "axios";
export default class DownloadReportService {
    downloadReportTime(data) {
        // return  fetch('/api/download-report-time', {
        //     method: 'POST',
        //     headers: {
        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //     },
        //     body: JSON.stringify(data),
        //
        // })
        //     .then((res) => res.json())
        axios.post('/api/download-report-time', data)
            .then(res => { console.log(res) })
            .catch(error => { console.log(error.response) })
    }

    downloadReportDoc(data) {
        // return  fetch('/api/download-report-doc', {
        //     method: 'POST',
        //     headers: {
        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //     },
        //     body: JSON.stringify(data),
        // })
        //     .then((res) => res)
        axios.post('/api/download-report-doc', data)
            .then(res => { console.log(res) })
            .catch(error => { console.log(error.response) })
    }
}
