from django.shortcuts import render, redirect
from django.views.generic import ListView, DetailView
from django.views.generic.edit import FormMixin
from .models import Meme, Comentario

class MemeListView(ListView):
    model = Meme
    template_name = 'memes/listado_memes.html'
    context_object_name = 'memes'

class DetalleMemeView(FormMixin, DetailView):
    model = Meme
    template_name = 'memes/meme_detail.html'
    context_object_name = 'meme'

    def get_success_url(self):
        return self.request.path

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['comentarios'] = self.object.comentarios.order_by('-fecha')
        return context

    def post(self, request, *args, **kwargs):
        self.object = self.get_object()
        form = self.get_form()
        if form.is_valid():
            return self.form_valid(form)
        else:
            return self.form_invalid(form)

    def form_valid(self, form):
        comentario = form.save(commit=False)
        comentario.meme = self.object
        comentario.save()
        return super().form_valid(form)

class MemeCommentView(FormMixin, DetailView):
    model = Meme
    template_name = 'memes/meme_detail.html'
    context_object_name = 'meme'

    def get_success_url(self):
        return self.request.path

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['comentarios'] = self.object.comentarios.order_by('-fecha')
        return context

    def post(self, request, *args, **kwargs):
        self.object = self.get_object()
        form = self.get_form()
        if form.is_valid():
            return self.form_valid(form)
        else:
            return self.form_invalid(form)

    def form_valid(self, form):
        comentario = form.save(commit=False)
        comentario.meme = self.object
        comentario.save()
        return super().form_valid(form)
