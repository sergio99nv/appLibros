class FileHelper{
      
    /* metodo para validar el peso de del archivo*/
    //input.size el peso es en bytes
    //maxFileSize es en KB
    static validateSize(input , maxFileSize){  
        if(typeof input.size=="undefined") return false; 
         
         //convertimos  bytes a kilobytes(KB)
        const fileSize = input.size / 1024;
        return (fileSize <= maxFileSize);
    }


    /* metodo para validar  la extension de del archivo*/   
    static validateExt(input, extensions){
           if(typeof input.name=="undefined") return false;   
           const ext = FileHelper.getExtension(input)
           return ( extensions.indexOf(ext) > - 1 )   

    }


    static getExtension(input){
        const fileName = input.name.toLowerCase();
        const extPosicion = (fileName.lastIndexOf(".") + 1) 
        const ext = fileName.slice(extPosicion)
        return ext;
    }

    static getShortName(input){
        const extPosicion = input.name.lastIndexOf(".") ;
        const pureName  =  input.name.substr(0 ,   extPosicion);
        const maxSizeTextBegin =  25;
        const maxSizeTextEnd =  7;
        const inputNameBegin = pureName.substr(0, maxSizeTextBegin);
        let  inputNameEnd = "";
        let inputName  =  inputNameBegin; 
         if(pureName.length > maxSizeTextBegin){
             //(pureName.length - maxSizeTextBegin)
             inputNameEnd = pureName.substr( maxSizeTextEnd * -1);
             inputName = inputNameBegin  + "..." +  inputNameEnd
         }

        return  inputName +  "." +FileHelper.getExtension(input);

    }
 
 
 }

 export default FileHelper;
