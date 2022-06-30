import React, {useState, useEffect} from "react"
import axios from "axios";
import NewComponent from "../components/NewComponent";

function HelloWorld() {
  const [newListName, setNewListName] = useState('');
  const [todoList, setTodoList] = useState([]);
  const loadTodoList = () => {
    axios.get('/api/todo_lists')
        .then(response => {
            console.log(response.data)
          setTodoList(response.data)
        })
  }
  const handleChange = (e) => {
    setNewListName(e.target.value)
  }
  const addTodoList = () => {
    const newList = {
      "name": newListName
    }
    axios.post('/api/todo_lists', newList)
        .then(() => {
          loadTodoList()
          setNewListName('')
        })
  }

  useEffect(() => {
    loadTodoList()
  }, [])
  return (
      <div>
          <NewComponent />
          <a href="/truc/machin">lien</a>
          <ul>
              <input type="text" value={newListName} onChange={handleChange}/>
              <button onClick={addTodoList}>add</button>
              {todoList.map((item) => {
                  return (
                      <li key={item.id}>
                          {item.id} - {item.name}
                          <ul>
                              {item.todoItems.map((item) => {
                                  return (
                                      <li key={item.id}>{item.name}</li>
                                  )
                              })}
                          </ul>
                      </li>
                  )

              })}
          </ul>
      </div>
  )

}

export default HelloWorld
