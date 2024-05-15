document.addEventListener('DOMContentLoaded', function() {
    window.onscroll = function(){
            if(document.documentElement.scrollTop > 400) {
                document.querySelector('.go-top-container').classList.add('showed');
            
            }
            else{
                document.querySelector('.go-top-container').classList.remove('showed');
            }
    }

    const goTopContainer = document.querySelector('.go-top-container');
    if (goTopContainer) {
      goTopContainer.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    }
  });