class AppHelper{

    /**
     * 
     * @param {html} refHtml  El elemento al q le apliramos las clases(CSS)
     * @param {Array} cssClasses  Contine el listado de clases(CSS)
     * @param {Number} time La cantidad de tiempo q durara el efecto 
     */
    static markHtmlElement(refHtml, cssClasses,  time = 3500){
        
        try {
            refHtml.classList.add(...cssClasses)
            setTimeout(() => {
                refHtml.classList.remove(...cssClasses)
            }, time);
        } catch (error) {
            
        }
    }

}

export default AppHelper;