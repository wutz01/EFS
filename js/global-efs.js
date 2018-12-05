function notify (message, type) {
  $.notify({
    message: message
  },{
    type: type,
    placement: {
      from: 'top',
      align: 'right'
    },
    animate: {
  		enter: 'animated fadeInDown',
  		exit: 'animated fadeOutUp'
  	},
    newest_on_top: true
  })
}
