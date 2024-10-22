async function getTitleFormRequest() {
  try {
    const postData = await fetch("https://jsonplaceholder.typicode.com/posts/1");
    if (!postData.ok) throw new Error("Not ok");
    
    const post = await postData.json();
    return post.title;
  } catch (error) {
    throw new Error("Error getTitleFormRequest");
  }
}

const form = document.querySelector('form');

if (form) {
  window.addEventListener('load', async function() {
    const title = await getTitleFormRequest();
    form.children.title.value = title ?? '';
  });
}