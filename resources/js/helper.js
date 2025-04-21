export function formatToK(number) {
    if (number >= 1000) {
        const formatted = (number / 1000).toFixed(1).replace(/\.0$/, '');
        return formatted.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + 'K';
    }
    return number.toLocaleString('id-ID'); // untuk format seperti 999 → 999, atau 1.000
}

export function formatNumber(number) {
    // console.log(number.toLocaleString('id-ID'));
    return number.toLocaleString('id-ID'); // untuk format seperti 999 → 999, atau 1.000
}


export function convertDate(dateStr){
    const d = new Date(dateStr);
    const day = String(d.getDate()).padStart(2, '0');
    const monthNames = [
        'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
        'Jul', 'Agst', 'Sept', 'Oct', 'Nov', 'Dec'
    ];
    const month = monthNames[d.getMonth()];
    const year = d.getFullYear();
    return `${day} ${month} ${year}`;
}