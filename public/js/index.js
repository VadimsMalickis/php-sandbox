const Animal = {
  name: 'Cat',
  color: 'White',
  age: 12,
  food: ['meat, milk, corn'],
  address: {
    street: 'Priezu iela 2b',
    city: 'Boston',
    state: 'LV'
  },
  say: function () {
    console.log(this.name + ': Mew...')
  }
}



console.log(Animal)



// const s = 'orange, apple, mouse, tiger'
// s.split(',')
// console.log(s)
