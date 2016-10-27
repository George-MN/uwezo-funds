 <script type="text/javascript">
            var elMain = document.getElementById('myhead');

            setMainDims();
            document.body.onresize = setMainDims;

            function setMainDims() {
                elMain.style.height = (document.body.clientHeight - 200) + 'px';
                elMain.style.width = '99%'
                setTimeout("elMain.style.width = '100%'", 0);
            }
        </script>