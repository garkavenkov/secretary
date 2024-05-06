export default {
    methods: {
        prepareDataForDownload(res, fileName) {
            const url = window.URL.createObjectURL(new Blob([res.data]));
            const link = document.createElement('a');

            link.href = url;
            // let fileName = `sadcsdsdc.docx`;
            link.setAttribute('download', fileName);
            document.body.appendChild(link);
            link.click();
        }
    }
}