export default async function submitData(form, url) {
          try
          {
               let options = {
                    method: "POST",
                    body: new FormData(form)
               },
                    res = await fetch(url, options),
                    json = await res.json();
                                        
                    return json
          }
          catch(err)
          {
               console.log(err);
               alert("ocurrio un erro: " + err);
               return false
          }
}