@guest
  <footer class="py-3 text-center text-white w-100 guest-footer">
    <div class="container">
    <small>&copy; {{ date('Y') }} StudioTF — Todos os direitos reservados</small>
    </div>
  </footer>
@endguest

@auth
<footer class="footer-dark py-3 text-center text-white w-100">
    <div class="container">
    <small>&copy; {{ date('Y') }} StudioTF — Todos os direitos reservados</small>
    </div>
  </footer>
@endauth