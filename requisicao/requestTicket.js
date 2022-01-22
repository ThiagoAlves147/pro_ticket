const url = 'http://localhost/sistematickets/requisicao/requestSql.php';

const search  = document.querySelector('#pesquisar')

const adminTable = document.querySelector('#admin_table')

search.addEventListener('keyup', async (event) => {
  const query = event.target.value
  const formData = new FormData()

  const data = event.target.dataset.table

  formData.append('query', query)
  formData.append('status', data)

  const response = await fetch(url, { method: 'POST', body: formData })
  const text = await response.text()
  
  adminTable.innerHTML = text
})

