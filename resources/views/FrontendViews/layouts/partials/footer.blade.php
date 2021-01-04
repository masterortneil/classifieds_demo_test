</main>

    
        

    </div>
    
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/popper.min.js"></script>
        <script type="text/javascript" src="/js/app.js"></script>
        <script type="text/javascript">
            function searchForm(e){
                e.preventDefault()
                let key = document.getElementById("searchKeyInput").value
                let category = document.getElementById("searchInCategoryInput").value
                if (key === "") {
                    return;
                }
                window.location.href="/search?q="+key+"&category="+category
            }
        </script>
        @stack('scripts')
    </body>
</html>
