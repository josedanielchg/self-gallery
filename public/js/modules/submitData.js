export default async function submitData(data, url) {
          try
          {
               let options = {
                    method: "POST",
                    body: data,
               },
                    res = await fetch(url, options),
                    json = await res.json();
                    return json;
          }
          catch(err)
          {
               console.error('Error. Please try again: ' + err);
               return false
          }
}

export const displayLoader = ($spinner) => $spinner.classList.add('active');
export const hiddenLoader = ($spinner) => $spinner.classList.remove('active');