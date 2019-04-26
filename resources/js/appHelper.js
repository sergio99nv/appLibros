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

    static getCssProperty(elem, property){
        
        return window.getComputedStyle(elem,null).getPropertyValue(property);
     }



     static addEvent(object, type, callback) {
        if (object == null || typeof(object) == 'undefined') return;
       
        if (object.addEventListener) {
            object.addEventListener(type, callback, false);
        } else if (object.attachEvent) {
            object.attachEvent("on" + type, callback);
        } else {
            object["on"+type] = callback;
        }
    }



    static matchMediaMinWidth(size){
       return  window.matchMedia(`(min-width: ${size}px)`).matches;
    }

}

export default AppHelper;