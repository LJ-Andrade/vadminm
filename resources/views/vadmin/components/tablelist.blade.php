<div class="table-responsive table-list">          
    <table class="table table-striped">
        <thead>
            <tr>
                {{ $tableTitles }}
            </tr>
        </thead>
        <tbody>
            {{ $tableContent }}
            {{ $tableEmpty }}
        </tbody>
    </table>
    {{ $pagination }} 
</div>