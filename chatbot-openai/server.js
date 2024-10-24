const express = require('express');
const axios = require('axios');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;
const apiKey = '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'; // Substitua pela sua chave da OpenAI

app.use(bodyParser.json());

app.post('/api/chatbot', async (req, res) => {
    const userMessage = req.body.message;

    try {
        const response = await axios.post(
            'https://api.openai.com/v1/chat/completions',
            {
                model: 'gpt-4',
                messages: [
                    { role: 'system', content: 'Você é um chatbot útil.' }, // Personalize o comportamento aqui
                    { role: 'user', content: userMessage }
                ]
            },
            {
                headers: {
                    'Authorization': `Bearer ${apiKey}`,
                    'Content-Type': 'application/json'
                }
            }
        );

        const botResponse = response.data.choices[0].message.content;
        res.json({ response: botResponse });

    } catch (error) {
        // Exibe informações detalhadas sobre o erro
        if (error.response) {
            // O servidor da OpenAI retornou uma resposta com erro
            console.error('Erro na resposta da API:', error.response.data);
            console.error('Status:', error.response.status);
            console.error('Headers:', error.response.headers);
            res.status(error.response.status).send(`Erro na API: ${error.response.data}`);
        } else if (error.request) {
            // A requisição foi feita, mas nenhuma resposta foi recebida
            console.error('Erro na requisição:', error.request);
            res.status(500).send('Erro ao tentar se conectar à API da OpenAI.');
        } else {
            // Algum outro erro aconteceu na configuração da requisição
            console.error('Erro ao configurar a requisição:', error.message);
            res.status(500).send(`Erro: ${error.message}`);
        }
    }
});

app.listen(port, () => {
    console.log(`Servidor rodando na porta ${port}`);
});
