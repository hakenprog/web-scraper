export const getData = async (setData) => {
    try {
        const backendResponse = await fetch(process.env.MIX_WEB_SCRAPER_API_URL);
        const data = await backendResponse.json();
        setData(data);
    } catch {
        setData([]);
    }

}