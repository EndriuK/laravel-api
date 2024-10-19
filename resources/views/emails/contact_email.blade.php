<div style="width: 90%; margin: 0 auto; ">
    <header style="background-color: black; color: #fff">
        <h1 style="text-aling: center">StitchPress</h1>
    </header>
    <main>
        <h2>Nuovo contatto ricevuto dalla form del sito</h2>
        <p>Ecco i dati:</p>
        <table>
            <tbody>
                <tr>
                    <td><strong>Nome</strong></td>
                    <td>{{ $lead->name }}</td>
                </tr>
                <tr>
                    <td><strong>Cognome</strong></td>
                    <td>{{ $lead->surname }}</td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>{{ $lead->email }}</td>
                </tr>
                <tr>
                    <td><strong>Telefono</strong></td>
                    <td>{{ $lead->phone }}</td>
                </tr>
                <tr>
                    <td><strong>Messaggio</strong></td>
                    <td>{{ $lead->content }}</td>
                </tr>
            </tbody>
        </table>
    </main>
</div>